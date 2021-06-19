import axios from "axios";

const TOKEN = localStorage.getItem("TOKEN") || "";
export const req = ({
  method = "GET",
  data = {},
  url,
  params = {},
  headers = {},
  others = {},
}) => {
  return new Promise((resolve, reject) => {
    {
      const config = {
        baseURL: process.env.REACT_APP_API_URL + url,
        method,
        headers: {
          ...headers,
          "Content-Type": headers["Content-Type"] || "Application/json",
          Accept: headers["Accept"] || "application/json",
          Authorization: TOKEN ? `Bearer ${TOKEN}` : "",
        },
        data,
        ...others,
        withCredentials: false
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
