// const INITIAL_STATE = JSON.parse(localStorage.getItem('loggedIn')) ? true : false
const INITIAL_STATE = false;

export default function loginReducer(loggedIn = INITIAL_STATE, { type, payload }) {
    switch (type) {
        case 'TOGGLE_LOGIN':
            return !payload;
        default:
            return loggedIn;
    }
}