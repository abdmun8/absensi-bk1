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

import { Route, Switch } from "react-router-dom";
import { useSelector } from "react-redux";

function App() {
  const loggedIn = useSelector((state) => state.loggedIn);
  return (
    <Switch>
      <Route exact path="/" component={loggedIn ? Menu : Login} />
      <Route path="/absensi-guru" component={loggedIn ? AsensiGuru : Login} />
      {/* <Route path="/check" component={loggedIn ? CheckInOut : Login} /> */}
      <Route path="/kelas" component={loggedIn ? KelasToday : Login} />
      <Route path="/reader-qr" component={loggedIn ? ReaderQR : Login} />
      <Route
        path="/absensi-siswa"
        component={loggedIn ? AbsensiSiswa : Login}
      />
      <Route path="/jadwal-guru" component={loggedIn ? JadwalGuru : Login} />
    </Switch>
  );
}

export default App;
