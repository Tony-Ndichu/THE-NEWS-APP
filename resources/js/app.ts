// app.ts
import "./bootstrap"
import Vue from "vue"
import HomePage from "./components/HomePage.vue"

Vue.component('homepage', HomePage)

new Vue({
    el: '#app'
})
