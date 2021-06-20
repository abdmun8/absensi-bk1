import React from "react";
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

// const Login = React.lazy(() => import("./pages/Login"));
// const Loading = React.lazy(() => import("./pages/Loading"));

function App() {
  const history = useHistory();
  const loggedIn = useSelector((state) => state.loggedIn);
  const user = useSelector((state) =>
    JSON.parse(window.atob(state.currentUser))
  );
  console.log(user);
  console.log(Object.entries(user).length);
  if (Object.entries(user).length) {
    history.push("/dashboard");
  } else {
    setTimeout(() => {
      history.push("/login");
    }, 1000);

    return <div>Loading.. </div>;
  }
  // if (!loggedIn) {
  //   history.push("/login");
  //   return;
  // }

  // return <div>hello</div>;\

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
