import React, { useEffect } from "react";
import "./App.css";

import { Route, Routes, BrowserRouter, useNavigate } from "react-router-dom";
import { useSelector } from "react-redux";

// import Menu from "./components/templates/Menu";
import Login from "./pages/Login";
// import ReaderQR from "./components/pages/ReaderQR";
// import AsensiGuru from "./components/pages/AbsensiGuru";
// import JadwalGuru from "./components/pages/JadwalGuru";
// import KelasToday from "./components/pages/KelasToday";
import Dashboard from "./pages/Dashboard";
import Loading from "./pages/Loading";
import routes from "./routes";
import _ from "lodash";

const Template = () => {
  return <div>Template</div>;
};

function App() {
  const navigate = useNavigate();
  const user = useSelector((state) => state.currentUser);

  useEffect(() => {
    const timeout = setTimeout(() => {
      navigate("/login");
    }, 500);

    if (!_.isEmpty(user)) {
      clearTimeout(timeout);
      navigate("/dashboard");
    }
  }, [user]);

  return (
    <Routes>
      <Route path="/" element={<Loading />} />
      <Route path="/" element={<Template />} />
      {/* <Route exact path="/absensi-guru" component={AsensiGuru} />
      <Route exact path="/kelas" component={KelasToday} /> */}
      <Route path="/login" element={<Login />} />
      {/* <Route exact path="/reader-qr" component={ReaderQR} />
      <Route exact path="/absensi-siswa" component={AbsensiSiswa} />*/}
      <Route path="/dashboard/*" element={<Dashboard />} />
    </Routes>
  );
}

export default App;
