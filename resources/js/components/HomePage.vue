<template>
<div>
<div>
<div>
  <div id="app" class="w-full h-full bg-gray-200 p-8" style="min-height: 100vh; min-width: 100%;">
      <div class="max-w-md bg-white px-4 py-2 mx-auto rounded shadow">
        <h1 class="text-xl font-bold py-4">{{ appName}}</h1> 
        <div class="text-gray-500">
          Status: <span class="font-bold text-gray-800">{{ readingStatus }}</span>
        </div>
        <div v-if="toRead.length > 0">
          <h2>Reading list:</h2>
          <div v-for="(article, index) in toRead" :key="index" class="bg-gray-200 px-4 py-2 my-2 rounded shadow">
              <div @mouseenter="func1(article)" @mouseleave="func2(article)">
                <div class="flex">
                    <span class="text-grey-600">Name:</span> <span class="font-bold text-gray-900">{{ article.title}} - <a :href="article.url">Link</a></span>
                </div>
                <div>
                    <button class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3" @click="markAsRead(article.id)">Read it</button>
                    <a class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3" target="_" :href="article.url">Open</a>
                </div>
                <div v-if="func5(article)"   class="bg-gray-400 p-4">
                  Abstract: {{article.abstract}}
                </div>
              </div>
          </div> 
        </div>
        <button class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3 " @click.prevent="addReading">Add reading</button>
      </div>
  </div>
  </div>
  </div>
  </div>
</template>

<script lang="ts">
import axios from 'axios';

export default {
  name: 'App',
  data() {
    return {
      appName: "Random news site generator",
      alreadyRead: [],
      toRead:[],
      selected_article: null,
      fetchedReadings: [],
    }
  },
  components: {
    //
  },
  created() {
            axios
                .get('http://localhost:8000/api/readings')
                .then(response => {
                    this.toRead = response.data.data;
                    console.log("response==========>", response.data.data);
                });
        },
  computed: {
    readingStatus() {
      if (this.alreadyRead.length == 0 && this.toRead.length == 0) return "Add something to read to get the show started";
      if (this.alreadyRead.length > 0 && this.toRead.length == 0) return "Was that it? Add more below"
      if (this.toRead.length == 0) return "Get reading!"
      return "hmm - this is strange";
    }
  },
  methods: {
    // add a new article to the reading list
    addReading() {
      //include depedencny
      const axios = require('axios');
      // create get call to grab list of potential article soruces
      try {
        axios.get("/test-data.json").then(response => {
            // response          
            let res = response;
            // data from response
            let data = res.data;
            // make random number 
            let r = Math.max(Math.floor(Math.random() * 5) - 1,0);
            // get random article
            let ra = data.results[r];
            // update the state
            this.toRead.push(ra);
        });
      }
      catch (error) {
        alert(error);
      }
    
    },
    func5(article) {
      try{
        return this.selected_article.title == article.title;
      } catch(exception) {
        return false;
      }
    },
    func1(article) {
      return this.selected_article = article;
    },
    func2(article) {
      if (this.selected_article.title == article.title) this.selected_article = null;
    },
    markAsRead(id) {
      
      let i = this.toRead.findIndex(function(a) {
        return a.id == id;
      });
      this.toRead.splice(i,1);


      axios.post('http://localhost:8000/api/reading/update', {
          reading_id: id
      })
                .then(response => {
                    console.log("response==========>", response.data);
                });
    }
  }
}
</script>

