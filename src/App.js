import React from "react";
import "./App.css";

import Menu from "./components/templates/Menu";
import Login from "./components/pages/Login";
import ReaderQR from "./components/pages/ReaderQR";
// import CheckInOut from "./components/pages/CheckInOut";
import AsensiGuru from "./components/pages/AbsensiGuru";
import JadwalGuru from "./components/pages/JadwalGuru";
import KelasToday from "./components/pages/KelasToday";
import AbsensiSiswa from "./components/pages/AbsensiSiswa";
import Loading from "./components/pages/Loading";

import { Route, Switch } from "react-router-dom";
import { useSelector } from "react-redux";

function App() {
  const loggedIn = useSelector((state) => state.loggedIn);
  return (
    <Switch>
      <Route exact path="/" component={Loading} />
      <Route exact path="/absensi-guru" component={AsensiGuru} />
      <Route exact path="/kelas" component={KelasToday} />
      <Route exact path="/login" component={Login} />
      <Route exact path="/reader-qr" component={ReaderQR} />
      <Route exact path="/absensi-siswa" component={AbsensiSiswa} />
      <Route exact path="/jadwal-guru" component={JadwalGuru} />
    </Switch>
  );
}

export default App;
