import React, { useState } from "react";
import {
  Button,
  CssBaseline,
  TextField,
  Link,
  Grid,
  Box,
  Typography,
  Container,
  FormControlLabel,
  Switch,
  Slide,
  Snackbar,
} from "@material-ui/core";
import { useHistory } from "react-router-dom";
import { makeStyles } from "@material-ui/core/styles";
// import

import { useDispatch } from "react-redux";
import { req } from "../utils/request";

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
  const history = useHistory();
  const dispatch = useDispatch();
  const [loginForm, setLoginForm] = useState({ username: "", password: "" });
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

    req({ data: loginForm, method: "POST", url: "/auth/login" })
      .then((res) => {
        dispatch({ type: "SET_CURRENT_USER", payload: res.user });
        dispatch({ type: "SET_IS_LOGGEDIN", payload: true });
        history.push("/");
      })
      .catch((err) => {
        console.log(err);
      });
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
