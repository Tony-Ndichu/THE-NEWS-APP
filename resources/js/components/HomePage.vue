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
            <transition name="fade">
              <div @mouseenter="showAbstract(article)" @mouseleave="hideAbstract(article)">
                <div class="flex">
                    <span class="text-grey-600">Name:</span> <span class="font-bold text-gray-900">{{ article.title}} - <a :href="article.url">Link</a></span>
                </div>
                <div>
                    <button class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3" @click="markArticleAsRead(article.id)">Read it</button>
                    <a class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3" target="_" :href="article.url">Open</a>
                </div>
                <div class="bg-gray-400 p-4" v-if="checkIsSelectedArticle(article)">
                  Abstract: {{article.abstract}}
                </div>
              </div>
              </transition>
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
import { Component, Vue } from "vue-property-decorator";
import ArticleType from "../Interfaces/ArticleType";
import ArticleService from "../services/article";

@Component
export default class HomePage extends Vue {
      appName: string = "Random news site generator";
      alreadyRead: Array<ArticleType> = [];
      toRead:Array<ArticleType> = [];
      selectedArticle?: ArticleType | null = null;
      fetchedReadings: Array<ArticleType> = [];
      created() {
              ArticleService.fetchAllArticles().then(response => {
                      this.toRead = response.data.data;
                      console.log("response==========>", response.data.data);
                  });
        }
    get readingStatus():string {
      if (this.alreadyRead.length == 0 && this.toRead.length == 0) return "Add something to read to get the show started";
      if (this.alreadyRead.length > 0 && this.toRead.length == 0) return "Was that it? Add more below"
      if (this.toRead.length == 0) return "Get reading!"
      return "hmm - this is strange";
    }
  // methods: {
    // // add a new article to the reading list
    // addReading() {
    //   //include depedencny
    //   const axios = require('axios');
    //   // create get call to grab list of potential article soruces
    //   try {
    //     axios.get("/test-data.json").then(response => {
    //         // response          
    //         let res = response;
    //         // data from response
    //         let data = res.data;
    //         // make random number 
    //         let r = Math.max(Math.floor(Math.random() * 5) - 1,0);
    //         // get random article
    //         let ra = data.results[r];
    //         // update the state
    //         this.toRead.push(ra);
    //     });
    //   }
    //   catch (error) {
    //     alert(error);
    //   }
    
    // },
    public addReading(): void {
      ArticleService.fetchNewArticles().then(response => {
                      this.toRead = response.data.data;
                      console.log("response==========>", response.data.data);
                  });
    }
    public checkIsSelectedArticle(article: ArticleType): boolean {
      try{
        return this.selectedArticle.title == article.title;
      } catch(exception) {
        return false;
      }
    }

    public showAbstract(article: ArticleType): ArticleType {
      return this.selectedArticle = article;
    }

    public hideAbstract(): void {
      this.selectedArticle = null;
    }

    public markArticleAsRead(id: number): void {
      
      // let i = this.toRead.findIndex(function(a) {
      //   return a.id == id;
      // });
      // this.toRead.splice(i,1);

      ArticleService.markArticleAsRead(id).then(response => {
          console.log("response==========>", response.data);
      });
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

</style>

