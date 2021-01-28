import axios from "axios";

const TOKEN = localStorage.getItem("TOKEN") || "ok";
export const req = ({ method, data, url, params, headers }) => {
  return new Promise((resolve, reject) => {
    {
      const config = {
        baseURL: process.env.REACT_APP_API_URL + url,
        method: method,
        headers: {
          ...headers,
          "Content-Type": "Application/json",
          Authorization: `Bearer ${TOKEN},`,
        },
        data: JSON.stringify(data),
        params: params,
      };

      axios(config)
        .then((res) => {
          resolve(res.data);
        })
        .catch((err) => {
          reject(err.messages);
        });
    }
  });
};
