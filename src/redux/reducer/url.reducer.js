const INITIAL_STATE = localStorage.getItem('endpoint')

export default function urlReducer(url = INITIAL_STATE, { type, payload }) {
    switch (type) {
        case 'SET_URL':
            return !payload;
        default:
            return url;
    }
}