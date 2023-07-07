// const INITIAL_STATE = localStorage.getItem('currentUser') ? JSON.parse(localStorage.getItem('currentUser')) : {};
const INITIAL_STATE = null;

export default function userReducer(user = INITIAL_STATE, { type, payload }) {
  switch (type) {
    case "SET_CURRENT_USER":
      return payload;
    default:
      return user;
  }
}
