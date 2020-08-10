export default {

    LOAD_USERS(state, users) {
        state.users = users;
    },

    LOAD_USER(state, user) {
        state.user = user.data;
    },

    ACTIVE_BUTTON_ADD(state, active) {
        state.active_button_add = active;
    },

    ACTIVE_BUTTON_EDIT(state, active) {
        state.active_button_edit = active;
    },

}