import {
    API_BASE
} from '../../config'

const MODULE_BASE = 'forms'

const CONFIGS = {
    headers: {
        'content-type': 'multipart/form-data',
    }
}

export default {

    // api
    async getForms(context) {
        return await axios.get(`${API_BASE}${MODULE_BASE}`).then(response => context.commit('LOAD_FORMS', response.data))
    },

    async getForm(context, id) {
        return await axios.get(`${API_BASE}${MODULE_BASE}/${id}`).then(response => context.commit('LOAD_FORM', response.data))
    },

    async saveForm(context, formData) {
        return await axios.post(`${API_BASE}${MODULE_BASE}`, formData, CONFIGS)
    },

    async removeForm(context, id) {
        return await axios.delete(`${API_BASE}${MODULE_BASE}/${id}`)
    },

}