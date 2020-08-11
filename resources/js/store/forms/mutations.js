export default {

    LOAD_FORMS(state, forms) {
        state.forms = forms;
    },

    LOAD_FORM(state, form) {
        state.form = form.data;
    },

    ACTIVE_BUTTON_ADD_FORM(state, active) {
        state.active_button_add_form = active;
    },

}