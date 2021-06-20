import { combineReducers } from "redux";
import { persistReducer } from "redux-persist";
import storage from "redux-persist/lib/storage";

import userReducer from "./reducer/user.reducer";
import loginReducer from "./reducer/login.reducer";
import menuReducer from "./reducer/menu.reducer";
import checkinReducer from "./reducer/checkin.reducer";

const persistConfig = {
  key: "root",
  storage,
  whitelist: ["currentUser", "loggedIn", "checkedIn", "menus"],
};

const rootReducer = combineReducers({
  currentUser: userReducer,
  loggedIn: loginReducer,
  menus: menuReducer,
  checkedIn: checkinReducer,
});

export default persistReducer(persistConfig, rootReducer);
