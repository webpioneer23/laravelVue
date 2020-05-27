/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from '@/axios.js'

export default {
  // addItem({ commit }, item) {
  //   return new Promise((resolve, reject) => {
  //     axios.post("/api/data-list/products/", {item: item})
  //       .then((response) => {
  //         commit('ADD_ITEM', Object.assign(item, {id: response.data.id}))
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
  fetchUsers ({ commit }) {
    return new Promise((resolve, reject) => {
      // axios.get('/api/user-management/users')
      axios.get('/api/owners')
        .then((response) => {
          console.log("response", response)
          commit('SET_USERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchCountries ({ commit }) {
    return new Promise((resolve, reject) => {
      // axios.get('/api/user-management/users')
      axios.get('/api/countries')
        .then((response) => {
          commit('SET_COUNTRIES', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchUser (context, userId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/fetch_owner/${userId}`)
        .then((response) => {
          console.log("sdf",response)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeRecord ({ commit }, userId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/owner/${userId}`)
        .then((response) => {
          console.log("gggg", response);
          commit('REMOVE_RECORD', userId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
