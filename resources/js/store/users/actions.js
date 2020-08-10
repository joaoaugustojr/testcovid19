import {
    API_BASE
} from '../../config'
import { identity } from 'lodash'

const MODULE_BASE = 'users'

const CONFIGS = {
    headers: {
        'content-type': 'multipart/form-data',
    }
}

const CONFIGS_PATCH = {
    headers: {
        'content-type': 'application/x-www-form-urlencoded',
    }
}

export default {

    // api
    async getUsers(context) {
        return await axios.get(`${API_BASE}${MODULE_BASE}`).then(response => context.commit('LOAD_USERS', response.data))
    },

    async getUser(context, id) {
        return await axios.get(`${API_BASE}${MODULE_BASE}/${id}`).then(response => context.commit('LOAD_USER', response.data))
    },

    async saveUser(context, formData) {
        return await axios.post(`${API_BASE}${MODULE_BASE}`, formData, CONFIGS)
    },

    async editUser(context, {formData, id}) {
        return await axios.post(`${API_BASE}${MODULE_BASE}/${id}`, formData, CONFIGS_PATCH)
    },

    async removeUser(context, id) {
        return await axios.delete(`${API_BASE}${MODULE_BASE}/${id}`)
    },
}