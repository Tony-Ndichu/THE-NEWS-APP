<template>
   <div>
   <div>
   <div>
      <div id="app" class="w-full h-full bg-gray-200 p-8" style="min-height: 100vh; width: 100%;">
         <div style="text-transform: uppercase; font-size: 40px; font-weight: bold;">{{ appName }}</div>
         <button v-if="previousPageUrl != null" class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3 " @click.prevent="goToPrevPage">
            <font-awesome-icon icon="angle-left" />
            prev page
         </button>
         <button v-if="nextPageUrl != null" class="bg-red-400 text-white py-1 px-3 rounded-full font-bold shadow my-3 " @click.prevent="goToNextPage">
            next page 
            <font-awesome-icon icon="angle-right" />
         </button>

         Page {{ currentPage }} of {{ totalPages }}
         <div v-if="toRead.length > 0" class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
               <div v-for="(article, index) in toRead" :key="index" class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                  <article class="overflow-hidden rounded-lg shadow-lg bg-white">
                     <a class="block w-full" style="position: relative; height: 200px; cursor: pointer">
                        <div alt="Placeholder" class="block w-full" 
                           :style="`background-image: url(${article.image_url}); background-size: cover; position: absolute; width: 100%; height: 100%;`" />
                           <div class="bg-green-400 text-white py-1 px-3 rounded-full font-bold shadow my-3"  
                              style="font-size:12px; margin-left: 10px; position: absolute; top: 10%; right: 10%; color: white;"
                              @click="markArticleAsRead(article.id)">
                              Read It
                              <font-awesome-icon icon="check" />
                           </div>
                     </a>
                     <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                     <h1 class="text-lg">
                     <a class="no-underline hover:underline text-black" :href="article.url">
                     {{ truncateText(article.title, 66) }}
                     </a>
                     </h1>
                     </header>
                     <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                     <div class="flex items-center no-underline text-black">
                     <div alt="Placeholder" :style="`background-image: url(${article.image_url}); background-size: cover; height: 30px; width: 30px; border-radius: 50%;`" />
                     <p class="ml-2 text-sm" style="width:60%;">
                     {{ article.author }}
                     </p>
                     </div>
                     <p class="text-grey-darker text-sm">
                     {{ new Date(article.publishedAt).toDateString() }}
                     </p>
                     </footer>
                  </article>
                  <!-- END Article -->
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script lang="ts">
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
      links: Array<string> = [];
      nextPageUrl: string = "" ;
      previousPageUrl: string = "";
      currentPage: number = 0;
      totalPages: number = 0;
      created() {
              ArticleService.fetchArticles().then(response => {
                      const { links, data, next_page_url, prev_page_url, current_page, last_page } = response.data.data;
                      console.log("response.data.data==========>", response.data.data)
                      this.toRead = data;
                      this.nextPageUrl = next_page_url;
                      this.previousPageUrl = prev_page_url;
                      this.currentPage = current_page;
                      this.totalPages = last_page;
                  });
        }
    get readingStatus():string {
      if (this.alreadyRead.length == 0 && this.toRead.length == 0) return "Add something to read to get the show started";
      if (this.alreadyRead.length > 0 && this.toRead.length == 0) return "Was that it? Add more below"
      if (this.toRead.length == 0) return "Get reading!"
      return "hmm - this is strange";
    }

    public goToNextPage(): void {
        ArticleService.fetchNewArticles(this.nextPageUrl).then(response => {
          const { links, data, next_page_url, prev_page_url, current_page, last_page } = response.data.data;
            console.log("response.data.data==========>", response.data.data)
            this.toRead = data;
            this.nextPageUrl = next_page_url;
            this.previousPageUrl = prev_page_url;
            this.currentPage = current_page;
                      this.totalPages = last_page;
        });
    }

        public goToPrevPage(): void {
        ArticleService.fetchNewArticles(this.previousPageUrl).then(response => {
          const { links, data, prev_page_url, next_page_url, current_page, last_page } = response.data.data;
            console.log("response.data.data==========>", response.data.data)
            this.toRead = data;
            this.previousPageUrl = prev_page_url;
            this.nextPageUrl = next_page_url;
            this.currentPage = current_page;
            this.totalPages = last_page;
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

    public truncateText(str: string, length: number): string {
      const ending = '...'
      if (length == null) {
        length = 100;
      }
      if (str.length > length) {
        return str.substring(0, length - ending.length) + ending;
      } else {
        return str;
      }
    }

    public markArticleAsRead(id: number): void {
      
      let i = this.toRead.findIndex(function(a) {
        return a.id == id;
      });
      this.toRead.splice(i,1);

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

