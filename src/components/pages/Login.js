import React, { useState } from "react";
import Button from "@material-ui/core/Button";
import CssBaseline from "@material-ui/core/CssBaseline";
import TextField from "@material-ui/core/TextField";
import Link from "@material-ui/core/Link";
import Grid from "@material-ui/core/Grid";
import Box from "@material-ui/core/Box";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Switch from "@material-ui/core/Switch";
import Slide from "@material-ui/core/Slide";
import Snackbar from "@material-ui/core/Snackbar";
// import

import { useDispatch, useSelector } from "react-redux";
import { login } from "../../utils/JWTAuth";
import { req } from "../../utils/request";

const DevelovedBy = () => {
  return (
    <Typography variant="body2" color="textSecondary" align="center">
      {"Developed by "}
      <Link color="inherit" href="http://www.5xstudio.id">
        5X Studio
      </Link>
    </Typography>
  );
};

const useStyles = makeStyles((theme) => ({
  "@global": {
    body: {
      backgroundColor: theme.palette.common.white,
    },
  },
  paper: {
    marginTop: theme.spacing(6),
    display: "flex",
    flexDirection: "column",
    alignItems: "center",
  },
  avatar: {
    margin: theme.spacing(1),
    backgroundColor: theme.palette.secondary.main,
  },
  form: {
    width: "100%", // Fix IE 11 issue.
    marginTop: theme.spacing(1),
  },
  submit: {
    margin: theme.spacing(3, 0, 2),
    backgroundColor: "#661FFF",
    borderRadius: 25,
  },
  logo: {
    width: "10em",
    height: "auto",
    marginBottom: theme.spacing(1),
  },
  btnPrimary: {
    backgroundColor: "#661FFF",
  },
  snackbar: {
    margin: theme.spacing(1),
  },
}));

export default function Login() {
  const classes = useStyles();
  const [loginForm, setLoginForm] = useState({ username: "", password: "" });
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [isSubmit, setIsSubmit] = useState(false);
  const [fieldError, setFieldError] = useState({
    username: false,
    password: false,
  });
  const [snackBarState, setSnackBarState] = useState({
    open: false,
    vertical: "top",
    horizontal: "center",
  });
  const [state, setState] = useState({
    urlOutside: false,
  });
  let loggedIn = useSelector((state) => state.loggedIn);
  const dispatch = useDispatch();

  const handleSnackbarClose = () => {
    setSnackBarState({ ...snackBarState, open: false });
  };

  const handleSnackbarOpen = () => {
    setSnackBarState({ ...snackBarState, open: false });
  };

  const doLogin = async () => {
    setIsSubmit(true);
    let countError = 0;
    let errors = {};
    Object.entries(fieldError).forEach((item) => {
      if (loginForm[item[0]] === "") {
        errors[item[0]] = true;
        countError++;
      } else {
        errors[item[0]] = false;
      }
    });
    setFieldError(errors);

    if (countError > 0) {
      return;
    }

    req({ data: loginForm, method: "POST", url: "/login" })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => {
        console.log(err);
      });

    // let response = await login(info);
    // if (response && response.success) {
    //   // alert(2)
    //   dispatch({ type: "SET_CURRENT_USER", payload: response.data });
    //   dispatch({ type: "TOGGLE_LOGIN", payload: loggedIn });
    //   dispatch({
    //     type: "SET_MENU",
    //     payload: state.urlOutside ? menuOutside : menuInside,
    //   });
    // } else {
    //   alert("Username/Password Salah!");
    // }
    // alert(1)
  };

  const menuOutside = [
    {
      idMenu: 1,
      link: "/report",
      title: "Izin",
      icon: "edit_attributes",
      iconColor: "red",
    },
    {
      idMenu: 2,
      link: "/jadwal-guru",
      title: "Jadwal",
      icon: "insert_invitation",
      iconColor: "red",
    },
  ];

  const menuInside = [
    {
      idMenu: 1,
      link: "/absensi-guru",
      title: "Absensi Guru",
      icon: "person",
      iconColor: "red",
    },
    {
      idMenu: 2,
      link: "/kelas",
      title: "Absensi Siswa",
      icon: "people",
      iconColor: "red",
    },
    {
      idMenu: 3,
      link: "/report",
      title: "Ekskul",
      icon: "local_play",
      iconColor: "red",
    },
    {
      idMenu: 4,
      link: "/report",
      title: "Izin",
      icon: "edit_attributes",
      iconColor: "red",
    },
    {
      idMenu: 5,
      link: "/jadwal-guru",
      title: "Jadwal",
      icon: "insert_invitation",
      iconColor: "red",
    },
  ];

  const { vertical, horizontal, open } = snackBarState;

  const handleChange = (name) => (event) => {
    setState({ ...state, [name]: event.target.checked });
    let menus = event.target.checked ? menuOutside : menuInside;
    dispatch({ type: "SET_MENU", payload: menus });
    // try {
    //   localStorage.setItem('isUrlOutside', event.target.checked)
    //   localStorage.setItem('menus', JSON.stringify(menus))
    // } catch (error) {
    //   console.log(error)
    // }
  };

  return (
    <Container component="main" maxWidth="xs">
      <Snackbar
        anchorOrigin={{ vertical, horizontal }}
        key={"top,center"}
        className={classes.snackbar}
        open={open}
        onClose={handleSnackbarClose}
        TransitionComponent={Slide}
        ContentProps={{
          "aria-describedby": "message-id",
        }}
        message={<span id="message-id">Login Success</span>}
      />
      <CssBaseline />
      <div className={classes.paper}>
        {/* <CircularProgress className={classes.progress} /> */}
        <img alt="Logo" className={classes.logo} src="icons-192.png" />
        <form className={classes.form} noValidate>
          <TextField
            variant="outlined"
            margin="normal"
            required
            fullWidth
            error={isSubmit && fieldError.username ? true : false}
            id="username"
            label="Username"
            name="username"
            onChange={(e) =>
              setLoginForm({ ...loginForm, username: e.target.value })
            }
            autoComplete="username"
            autoFocus
          />
          <TextField
            variant="outlined"
            margin="normal"
            required
            fullWidth
            error={isSubmit && fieldError.password ? true : false}
            name="password"
            label="Password"
            type="password"
            id="password"
            onChange={(e) =>
              setLoginForm({ ...loginForm, password: e.target.value })
            }
            autoComplete="current-password"
          />
          <FormControlLabel
            control={
              <Switch
                checked={state.urlOutside}
                onChange={handleChange("urlOutside")}
                value="urlOutside"
                color="primary"
              />
            }
            label="Luar Sekolah"
          />
          <Button
            type="button"
            fullWidth
            variant="contained"
            color="primary"
            className={classes.submit}
            onClick={doLogin}
          >
            LOGIN
          </Button>
          <Grid container>
            <Grid item xs>
              <Link href="#" variant="body2">
                Lupa Password?
              </Link>
            </Grid>
          </Grid>
        </form>
      </div>
      <Box mt={5}>
        <DevelovedBy />
      </Box>
    </Container>
  );
}
