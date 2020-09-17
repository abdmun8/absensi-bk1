export const getItem = async (key) =>
  new Promise((resolve, reject) => {
    localStorage
      .getItem(key)
      .then((res) => resolve(res.JSON()))
      .catch(reject(undefined));
  });

export const getItem = async (key, data) =>
  new Promise((resolve, reject) => {
    localStorage
      .setItem(key, JSON.stringify(data))
      .then(() => resolve(true))
      .catch(reject(false));
  });

export const loadState = () => {
  try {
    const serializedState = localStorage.getItem("state");
    if (serializedState === null) {
      return undefined;
    }
    return JSON.parse(serializedState);
  } catch (err) {
    return undefined;
  }
};

export const saveState = (state) => {
  try {
    const serializedState = JSON.stringify(state);
    localStorage.setItem("state", serializedState);
  } catch {
    // ignore write errors
  }
};
