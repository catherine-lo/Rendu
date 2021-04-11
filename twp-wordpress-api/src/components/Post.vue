<template>
  <v-data-table
    :headers="headers"
    :items="enters"
  >
    <template v-slot:top>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              New Item
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.title"
                      label="Title"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field type="text"
                      v-model="editedItem.content"
                      label="Description"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      <v-dialog v-model="dialogDelete" max-width="500px">
        <v-card>
          <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
        color="red"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>


<script>


export default{
  
   data: () => ({
        config:{
            headers:{
               Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3dvcmRwcmVzcyIsImlhdCI6MTYxNjk0NDExNywibmJmIjoxNjE2OTQ0MTE3LCJleHAiOjE2MTc1NDg5MTcsImRhdGEiOnsidXNlciI6eyJpZCI6IjEifX19.NsEFNztq9xp2sYkOPCEJWzUpT5kdSsJ3M86ryU99wiM'
            }
        },
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: 'Title',
          align: 'start',
          sortable: false,
          value: 'title',
        },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      enters: [],
      editedIndex: -1,
      editedItem: {
        title: '',
        id: '',
        content: '',
        date: '',
        status: '',
        categories: '',
      },
      defaultItem: {
        title: '',
        id: '',
        content: '',
        date: '',
        status: '',
        categories: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
        clean(value){
         return value.replace(/<\/?[^>]+(>|$)/g, "")
        },
      async initialize () {
        try {

                const entersDB = await this.axios.get('wp/v2/posts');

                console.log(entersDB.data);

                await entersDB.data.forEach(element => {
                    let item = {};
                    item.id = element.id;
                    item.title =element.title.rendered;
                    item.content = this.clean(element.content.rendered);
                    item.date = element.date;
                    item.status = element.status;
                    item.categories = element.categories;
                    this.enters.push(item);
                });
                
            } catch (error) {
                console.log(error);
            }
      },

      editItem (item) {
        this.editedIndex = this.enters.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      async deleteItem (item) {
        this.editedIndex = this.enters.indexOf(item)
        this.editedItem = Object.assign({}, item)
        const response = this.dialogDelete = true
        if(response){
           await this.axios.delete(`wp/v2/posts/${item.id}`, this.config)  
        }
      },

      deleteItemConfirm () {
        this.enters.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      async save () {
        if (this.editedIndex > -1) {
          
          //Edit
          //console.log(this.editedItem);
          
          try{
              await this.axios.post(`wp/v2/posts/${this.editedItem.id}`, this.editedItem, this.config)
              Object.assign(this.enters[this.editedIndex], this.editedItem)
          }catch (error){
              console.log(error);
          }
          
        } else {
          //Add
          //console.log(this.editedItem);

          const enter = {
              title: this.editedItem.title,
              content: this.editedItem.content,
              status: 'publish',
              categories: this.editedItem.categories
          }

          try{

          const enterDB = await this.axios.post('wp/v2/posts', enter, this.config)

          //console.log(enterDB.data);

          this.editedItem.id = enterDB.data.id;
          this.editedItem.date = enterDB.data.date;
          this.editedItem.status = enterDB.data.status;
          this.editedItem.categories = enterDB.data.categories;
          

          this.enters.push(this.editedItem)

          }catch(error){
              console.log(error);
          }

         
        }
        this.close()
      },
    },
  }
</script>