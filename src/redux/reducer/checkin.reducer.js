const INITIAL_STATE = JSON.parse(localStorage.getItem('checkedIn')) ? true : false

export default function loginReducer(checkedIn = INITIAL_STATE, { type, payload }) {
    switch (type) {
        case 'TOGGLE_CHECKIN':
            return !payload;
        default:
            return checkedIn;
    }
}