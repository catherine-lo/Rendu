<template>

  <v-container fluid>
    <v-slide-y-transition mode="out-in">
      <v-layout row align-center wrap>
        <v-flex sm3 v-for="enter in enters" :key="enter._id" pa-2>
          <v-card>
            <v-dialog
              v-model="dialogCard"
              max-width="500px"
              >
              <v-card>
                <v-card-title>
                  <span class="headline">{{ formName }}</span>
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
                          v-model="editedCard.name"
                          label="Name"
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="6"
                        md="4"
                      >
                        <v-text-field type="text"
                          v-model="editedCard.description"
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
                    @click="closeCard"
                  >
                    Cancel
                  </v-btn>
                  <v-btn
                    color="blue darken-1"
                    text
                    @click="saveCard"
                  >
                    Save
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-icon
              small
              @click="deleteCard(enter)"
              color="red"
              >
              mdi-close
            </v-icon>
            <v-icon
              small
              class="mr-2"
              @click="editCard(enter)"
              >
              mdi-pencil
            </v-icon>
            <v-card-title primary-title>
              <div class="headline">{{enter.name}}</div>
            </v-card-title>
            <v-dialog v-model="dialogDeleteCard" max-width="500px">
              <v-card>
                <v-card-title class="headline">Are you sure you want to delete this Card?</v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDeleteCard">Cancel</v-btn>
                  <v-btn color="blue darken-1" text @click="deleteCardConfirm">OK</v-btn>
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <!-- for post in posts  
              if enter._id == post_categories -->
            <v-card-actions>
              <create-post></create-post>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex sm3>
          <v-card>
            <v-card-title primary-title style="flex-direction: column;">
              <v-form
                v-if="!creating"
                v-model="valid"
                @submit.prevent="createEnter"
                @keydown.prevent.enter>
                <v-text-field
                  v-model="editedCard.name"
                  :rule="notEmptyRules"
                  label="Name"
                  required>
                </v-text-field>
                <v-text-field
                  v-model="editedCard.description"
                  :rule="notEmptyRules"
                  label="Description"
                  required>
                </v-text-field>
              </v-form>
            </v-card-title>
            <v-card-actions>
              <v-btn
                color="secondary"
                text
                @click="saveCard"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-slide-y-transition>
  </v-container>
</template>

<script>
import CreatePost from './Post';
export default {
  name: 'enters',
  components: {
    CreatePost
  },
  
  data: () => ({
    Card: false,
    dialogCard: false,
    dialogDeleteCard: false,
    enters: [],
    editedIndex: -1,
    editedCard: {
      name: '',
      id: '',
      description: '',
    },
    defaultCard: {
      name: '',
      id: '',
      description: '',
    },
    creating: false,
    valid: false,
    enter: {
      name: '',
      description: '',
    },
    notEmptyRules: [(value) => !!value || 'Cannot be empty. '],
    config:{
      headers:{
        Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL3dvcmRwcmVzcyIsImlhdCI6MTYxNjk1MzIxNSwibmJmIjoxNjE2OTUzMjE1LCJleHAiOjE2MTc1NTgwMTUsImRhdGEiOnsidXNlciI6eyJpZCI6IjEifX19.7PAcjVs9Mtk1RYm5ZBbIHbwl4H8mVBg0UlTFsyUP1i4'
      }
    },
  }),
  computed: {
    formName () {
      return this.editedIndexCard === -1 ? 'New Card' : 'Edit Card'
    },
  },

  watch: {
    dialogCard (val) {
      val || this.closeCard()
    },
    dialogDeleteCard (val) {
      val || this.closeDeleteCard()
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
        const entersDB = await this.axios.get('wp/v2/categories');
        // console.log(entersDB.data);
        
        await entersDB.data.forEach(element => {
          //console.log(element);
          let card = {};
          card.id = element.id;
          card.name = element.name;
          card.description = this.clean(element.description);
          this.enters.push(card);
        });                
      } catch (error) {
        console.log(error);
      }
    },

    editCard (card) {
      this.editedIndexCard = this.enters.indexOf(card)
      this.editedCard = Object.assign({}, card)
      this.dialogCard = true
    },

    async deleteCard (card) {
      this.editedIndexCard = this.enters.indexOf(card)
      this.editedCard = Object.assign({}, card)
      const response = this.dialogDeleteCard = true
      if(response){
        await this.axios.delete(`wp/v2/categories/${card.id}?force=true`, this.config)  
      }
    },

    deleteCardConfirm () {
      this.enters.splice(this.editedIndexCard, 1)
      this.closeDeleteCard()
    },

    closeCard () {
      this.dialogCard = false
      this.$nextTick(() => {
        this.editedCard = Object.assign({}, this.defaultCard)
        this.editedIndexCard = -1
      })
    },

    closeDeleteCard () {
      this.dialogDeleteCard = false
      this.$nextTick(() => {
        this.editedCard = Object.assign({}, this.defaultCard)
        this.editedIndexCard = -1
      })
    },

    async saveCard () {
      if (this.editedIndexCard > -1) {
        //Edit
        //console.log(this.editedCard);
        try{
            await this.axios.post(`wp/v2/categories/${this.editedCard.id}`, this.editedCard, this.config)
            Object.assign(this.enters[this.editedIndexCard], this.editedCard)
        }catch (error){
          console.log(error);
        }
      } else {
        //Add
        //console.log(this.editedCard);
        const enter = {
          name: this.editedCard.name,
          description: this.editedCard.description,
        }
        try{
          const enterDB = await this.axios.post('wp/v2/categories', enter, this.config)
          //console.log(enterDB.data);
          this.editedCard.id = enterDB.data.id;
          this.enters.push(this.editedCard)
          }catch(error){
            console.log(error);
          }
      }
      this.closeCard()
    },
  },
}
</script>