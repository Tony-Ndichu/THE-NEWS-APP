<template>
    <h1>Welcome to the News App</h1>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from "vue-class-component";

@Component
export default class HomePage extends Vue {
    mounted() : void {
        console.log("welcome to the news app");
    }
}
</script>
