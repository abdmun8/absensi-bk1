import React, { useEffect } from "react";
import "./App.css";

import { Route, Switch, useHistory } from "react-router-dom";
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

function App() {
  const history = useHistory();
  const user = useSelector((state) => state.currentUser);

  useEffect(() => {
    const timeout = setTimeout(() => {
      history.push("/login");
    }, 500);

    if (!_.isEmpty(user)) {
      clearTimeout(timeout);
      history.push("/dashboard");
    }
  }, [user]);

  return (
    <Switch>
      {/* {routes.map((route) => (
        <Route
          key={route.path}
          exact={route.exact}
          path={route.path}
          component={route.component}
        />
      ))} */}
      <Route exact path="/" component={Loading} />
      {/* <Route exact path="/absensi-guru" component={AsensiGuru} />
      <Route exact path="/kelas" component={KelasToday} /> */}
      <Route exact path="/login" component={Login} />
      {/* <Route exact path="/reader-qr" component={ReaderQR} />
      <Route exact path="/absensi-siswa" component={AbsensiSiswa} />*/}
      <Route exact path="/dashboard" component={Dashboard} />
    </Switch>
  );
}

export default App;
