<template>
    <div class="wrapper">

    <div class="container">
    <div class="loader"></div> 
    <p class="loader-text">Fetching you the latest news...</p>
    </div>
    </div>
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";

@Component
export default class Loader extends Vue {
}

</script>

<style scoped>
.loader {
  border: 5px solid #f3f3f3; /* Light grey */
  border-top: 5px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 0.5s linear infinite;
}

.loader-text {
    margin-left: 20px;
}

.wrapper {
    width:100%;

}
.container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    width: 100%;
    margin-top: 10%;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>