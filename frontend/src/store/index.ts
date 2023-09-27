import {createStore} from 'vuex';


interface State {
  token: string;
}


export default createStore({
  state: {
    token: localStorage.getItem('token') ?? ''
  },
  getters: {
  },
  mutations: {
    LOGIN(state: State, token: string) {
      state.token = token;
    },
    LOGOUT(state: State) {
      state.token = '';
    } 
  },
  actions: {
    login(context, token) {
      context.commit('LOGIN', token);
    },
    logout(context) {
      context.commit('LOGOUT');
    }
  },
  modules: {
  }
});
