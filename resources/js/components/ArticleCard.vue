<template>
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
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";
import { Prop } from "vue-property-decorator";
import ArticleType from "../Interfaces/ArticleType";

@Component
export default class ArticleCard extends Vue {
    @Prop({ required: true })
    article : ArticleType;
    @Prop({ required: true })
    truncateText: Function;
    @Prop({ required: true })
    markArticleAsRead: Function;
}

</script>