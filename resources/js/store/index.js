import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import users from './users'
import forms from './forms'

const store = new Vuex.Store({
    modules: {
        users,
        forms
    }
})

export default store