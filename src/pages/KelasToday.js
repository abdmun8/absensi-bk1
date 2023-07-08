import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import Typography from "@material-ui/core/Typography";
import Navbar from "../components/templates/NavbarApp";
import Icon from "@material-ui/core/Icon";
// import { Redirect } from "react-router-dom";
import { useSelector } from "react-redux";
import axios from "axios";
const useStyles = makeStyles((theme) => ({
  root: {
    marginTop: theme.spacing(9),
  },
  paper: {
    padding: theme.spacing(2),
    margin: theme.spacing(2),
  },
  left: {
    display: "inline-block",
  },
  right: {
    display: "inline-block",
    position: "absolute",
    right: theme.spacing(5),
    fontWeight: "bold",
    fontFamily: "ubuntu",
    fontSize: "4em",
    color: "#ddd",
  },
  font: {
    fontFamily: "ubuntu",
  },
}));

const getKelas = async (token) => {
  let SERVER_URL = "http://localhost/abcd/absensi-bk1/admin/api/";
  const url = `${SERVER_URL}protected`;
  try {
    let response = axios
      .get(url, { headers: { Authorization: `Bearer ${token}` } })
      .then(
        (response) => {
          // var response = response.data;
          console.log(response);
        },
        (error) => {
          // var status = error.response.status;
          console.log(error);
        }
      );
    // let response = await axios.post(LOGIN_ENDPOINT, token);
    console.log(response);
    // if (response.status === 200 && response.data.jwt) {
    //   return { success: true, data: user };
    // } else {
    //   return { success: false, data: {} };
    // }
  } catch (e) {
    console.log(e);
  }
};

export default function PaperSheet() {
  const classes = useStyles();
  let checkedIn = useSelector((state) => state.checkedIn);
  const token = useSelector((state) => state.currentUser.access_token);
  if (!checkedIn) {
    alert("Silahkan Absen Terlebih dahulu");
    // return <Redirect to="/" />;
  }
  const kelas = getKelas(token);

  // const kelas = [1, 2, 3, 4, 5, 6, 7, 8, 9];

  return (
    <React.Fragment>
      <Navbar appBarData={{ isMenu: 0, title: "Kelas" }} />
      {/* <div className={classes.root}>
        {kelas &&
          kelas.map(item => (
            <Paper className={classes.paper} key={item}>
              <div className={classes.left}>
                <Typography component="p">08:00 - 09:30</Typography>
                <Typography
                  variant="h5"
                  component="h3"
                  className={classes.font}
                >
                  KELAS IX MESIN
                </Typography>
                <Typography component="p">Ilmu Pengetahuan Alam</Typography>
              </div>
              <div className={classes.right}>{`#${item}`}</div>
            </Paper>
          ))}
      </div> */}
    </React.Fragment>
  );
}
