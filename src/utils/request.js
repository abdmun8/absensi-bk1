import axios from "axios";

const instance = axios.create({
  baseURL: process.env.REACT_APP_API_URL,
  timeout: 30000,
});

instance.interceptors.request.use((config) => {
  const TOKEN = localStorage.getItem("TOKEN") || "";
  config.headers = {
    ...config.headers,
    "Content-Type": config.headers["Content-Type"] || "Application/json",
    Accept: config.headers["Accept"] || "application/json",
    Authorization: TOKEN ? `Bearer ${TOKEN}` : "",
  };
  
  return config;
});

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
      instance({
        url,
        method,
        data,
        ...others,
      })
        .then((res) => {
          resolve(res.data);
        })
        .catch((err) => {
          reject(err.messages);
        });
    }
  });
};
