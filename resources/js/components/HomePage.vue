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
         <div v-if="!loading" class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
               <div v-for="(article, index) in toRead" :key="index" class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                  <article-card
                    :article="article"
                    :truncateText="truncateText"
                    :markArticleAsRead="markArticleAsRead"
                    />
                  </div>
                  </div>
               </div>
               <div v-else>
                  <loader />
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
import ArticleCard from "./ArticleCard.vue";
import Loader from "./Loader.vue";

@Component({
  components: { ArticleCard, Loader }
})

export default class HomePage extends Vue {
      appName: string = "The News App";
      toRead:Array<ArticleType> = [];
      links: Array<string> = [];
      nextPageUrl: string = "" ;
      previousPageUrl: string = "";
      currentPage: number = 0;
      totalPages: number = 0;
      loading: boolean = true;

      created() {
        this.loading = true;
        ArticleService.fetchArticles().then(response => {
                const { links, data, next_page_url, prev_page_url, current_page, last_page } = response.data.data;
                this.toRead = data;
                this.nextPageUrl = next_page_url;
                this.previousPageUrl = prev_page_url;
                this.currentPage = current_page;
                this.totalPages = last_page;
                this.loading = false;
            });

        }

        public goToNextPage(): void {
          this.loading = true;
            ArticleService.fetchNewArticles(this.nextPageUrl).then(response => {
              const { links, data, next_page_url, prev_page_url, current_page, last_page } = response.data.data;
                this.toRead = data;
                this.nextPageUrl = next_page_url;
                this.previousPageUrl = prev_page_url;
                this.currentPage = current_page;
                this.totalPages = last_page;
                this.loading = false;
            });
        }

        public goToPrevPage(): void {
          this.loading = true;
            ArticleService.fetchNewArticles(this.previousPageUrl).then(response => {
              const { links, data, prev_page_url, next_page_url, current_page, last_page } = response.data.data;
                this.toRead = data;
                this.previousPageUrl = prev_page_url;
                this.nextPageUrl = next_page_url;
                this.currentPage = current_page;
                this.totalPages = last_page;
                this.loading = false;
            });
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

          ArticleService.markArticleAsRead(id);
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

