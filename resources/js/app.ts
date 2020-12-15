// app.ts
import "./bootstrap"
import Vue from "vue"
import HomePage from "./components/HomePage.vue"
import { library } from '@fortawesome/fontawesome-svg-core'
import { faAngleRight, faAngleLeft, faCheck } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faAngleRight, faCheck)
library.add(faAngleLeft)

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.component('homepage', HomePage)

new Vue({
    el: '#app'
})
