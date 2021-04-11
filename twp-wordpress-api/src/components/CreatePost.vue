<template>
   
      <v-layout row align-center wrap>
        <v-flex sm3 v-for="enter in enters" :key="enter._id" pa-2>
          <v-card>
            <v-card-title primary-title>
              <div class="headline">{{enter.name}}</div>
            </v-card-title>
            <v-card-actions>
              
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex sm3>
          <v-card>
            <v-card-title primary-title style="flex-direction: column;">
              
              <v-form
                v-if="!creatingPost"
                v-model="validPost"
                @submit.prevent="createPost"
                @keydown.prevent.enter>
                <v-text-field
                  v-model="editedCard.name"
                  :rule="notEmptyRules"
                  label="Title"
                  required>
                </v-text-field>
              </v-form>
            </v-card-title>
            <v-card-actions>
              <v-btn
                color="secondary"
                text
                @click="save"
              >
                Create Post
              </v-btn>
        
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    
  
</template>
<script>
export default{
  name: 'create-post',
  props: ['id', 'categoriesId'],
  data: () => ({
       post: {
         title: '',
         content: '',
       }
    }),

  methods: {
    async createPost() {
        if (this.validPost) {
          const entersDB = await this.axios.get('wp/v2/posts');
          this.post.cardId = this.cardId;
          this.post.listId = this.listId;
          const post = new Post(this.post);
          list.save();
          this.post = {
            title: '',

          };
        } 

      },
  },

};

</script>


