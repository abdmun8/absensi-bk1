// import React from 'react'
import axios from "axios";

let isUrlOutside = localStorage.getItem("isUrlOutside") ? true : false;
const outside = "https://absen.smkbk1-krw.sch.id/admin/api/";
const inside = "https://absen.smkbk1-krw.sch.id/admin/api/";
let SERVER_URL = isUrlOutside ? outside : inside;

const login = async data => {
  const LOGIN_ENDPOINT = `${SERVER_URL}login`;
  let user = null;
  try {
    let response = await axios.post(LOGIN_ENDPOINT, data);
    if (response.status === 200 && response.data.jwt) {
      let jwt = response.data.jwt;
      user = {
        name: response.data.name,
        username: response.data.username,
        jk: response.data.jk,
        nik: response.data.nik,
        id: response.data.id,
        access_token: jwt
      };

      // localStorage.setItem("access_token", jwt);
      // localStorage.setItem("loggedIn", 1);
      // localStorage.setItem("currentUser", JSON.stringify(user));
      return { success: true, data: user };
    } else {
      return { success: false, data: {} };
    }
  } catch (e) {
    console.log(e);
  }
};

const register = async data => {
  const SIGNUP_ENDPOINT = `${SERVER_URL}/api/register.php`;
  try {
    let response = await axios({
      method: "post",
      responseType: "json",
      url: SIGNUP_ENDPOINT,
      data: data
    });
  } catch (e) {
    console.log(e);
  }
};

const logout = () => {
  try {
    // localStorage.setItem('access_token', '')
    // localStorage.setItem('loggedIn', false)
    // localStorage.setItem('currentUser', JSON.stringify({}))
    localStorage.setItem("persist:root", JSON.stringify({}));
    return true;
  } catch (e) {
    return false;
  }
};

const absenGuru = async data => {
  const LOGIN_ENDPOINT = `${SERVER_URL}absen-guru`;
  try {
    let response = await axios.post(LOGIN_ENDPOINT, data);
    // console.log(response);
    if (response.status === 200 && response.data.success) {
      return { success: true, data: {}, message: response.data.message };
    } else {
      return { success: false, data: {}, message: response.data.message };
    }
  } catch (e) {
    console.log(e);
  }
};

export { login, register, logout, absenGuru };
