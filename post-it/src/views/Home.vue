<template>
    <Header @toggle-add-note="toggleAddNote" 
    title="Your post-it notes list" 
    :showAddNote="showAddNote"/>
    <div v-show="showAddNote">
      <AddNote @add-note= "addNote"/>
    </div>
    <div class="box">
      <Notes @delete-note="deleteNote" :notes="notes" />
    </div>
</template>

<script>
import Header from '../components/Header'
import Notes from '../components/Notes'
import AddNote from '../components/AddNote'

export default {
   name: 'Home',
   components: {
       Header,
       Notes,
       AddNote
   },
   data() {
       return{
           notes: Array,
           showAddNote: false,
       }
   },
   methods: {
     toggleAddNote(){
       this.showAddNote = !this.showAddNote
     },
     async addNote(note){
       const res = await fetch('api/notes', {
         method: 'POST',
         headers: {
           'Content-type': 'application/json',
         },
         body: JSON.stringify(note),
       })

      const data = await res.json()
      this.notes = [...this.notes, data]
    },
    async deleteNote(id){
      if(confirm('Are you sure?')){
        const res = await fetch(`api/notes/${id}`, {
          method: 'DELETE',
        }) 
       res.status === 200 
       ? (this.notes = this.notes.filter(
         (note)=> note.id !==id)) 
         : alert('Error deleting') 
      }
    },
    async fetchNotes(){
      const res = await fetch('api/notes')
      const data = await res.json()
      return data
    },
  },

  async created() {
    this.notes = await this.fetchNotes()
  },
}
</script>

<style>
 *{
        margin:0;
        padding:0;
    }
   
body{
        font-family:arial,sans-serif;
        font-size:100%;
        margin:3em;
        background: pink;
        color:#fff;
    }


.btn {
  display: inline-block;
  background: black;
  color: white;
  border: none;
  padding: 10px 20px;
  margin: 5px;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
  font-size: 15px;
  font-family: inherit;
}

.btn:focus{
  outline: none;
}

.box {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  padding: 100px;
}
</style>
