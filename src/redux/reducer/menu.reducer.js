const INITIAL_STATE = [];

export default function urlReducer(menus = INITIAL_STATE, { type, payload }) {
    switch (type) {
        case 'SET_MENU':
            return payload;
        default:
            return menus;
    }
}