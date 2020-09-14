const INITIAL_STATE = localStorage.getItem('isUrlOutside') ? true : false;

export default function urlOutsideReducer(isUrlOutside = INITIAL_STATE, { type, payload }) {
    console.log(payload)
    switch (type) {
        case 'TOGGLE_URL_OUTSIDE':
            return !payload;
        default:
            return isUrlOutside;
    }
}