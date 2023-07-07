import React, { useState, useEffect } from "react";
import NavbarApp from "../components/templates/NavbarApp";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Container from "@material-ui/core/Container";
import Icon from "@material-ui/core/Icon";
import Paper from "@material-ui/core/Paper";
import Grid from "@material-ui/core/Grid";
import axios from "axios";
import Button from "@material-ui/core/Button";
import qs from "qs";
import urls from "../utils/urls";
import { req } from "../utils/request";
import { useSelector } from "react-redux";
import _ from "lodash";

export default function Dashboard() {
  const classes = useStyles();
  const currentUser = useSelector((state) => state.currentUser);
  const user = useSelector((state) => state.currentUser);
  const [listjadwal, setListJadwal] = useState([]);

  useEffect(() => {
    if (user) {
      req({ url: urls.jadwalByGuruHariIni + user.id })
        .then((res) => {
          setListJadwal(res.data);
        })
        .catch((err) => console.log({ err }));
    }
  }, [user]);

  if(!currentUser) return <div />

  return (
    <>
      <NavbarApp appBarData={{ isMenu: 0, title: "Dashboard" }} />
      <Container className={classes.root}>
        <Icon className={classes.photo}>face</Icon>
        <Typography className={classes.nama}>dashboard</Typography>
        <Typography>Jadwal Hari ini</Typography>
        {listjadwal.map((item) => {
          return (
            <div className="bg-red-500">
              {_.upperCase(item.hari)} {item.nama_matpel} {item.durasi} Menit
            </div>
          );
        })}
      </Container>
    </>
  );
}

const CheckinOut = ({ location }) => {
  const classes = useStyles();
  const params = new URLSearchParams(location.search);
  const nikNum = params.get("nik") && params.get("nik").replace("http://", "");
  if (!nikNum) window.open("/", "_self");
  const setTimeString = (dt) => dt.toTimeString().substr(0, 5);
  const setDateString = (dt) => dt.toLocaleDateString();

  const dt = new Date();
  const [namaEmployee, setNamaEmployee] = useState("");
  const [data, setData] = useState(dt);
  const [action, setAction] = useState("");
  // console.log(data)

  const URL = "https://api.sekawanpm.com/absensi";
  const key = "5b8e847c500b3a026824738c40246e75";

  // useEffect(() => {
  //   const fetchData = async () => {
  //     const result = await axios({
  //       url: URL + "/" + nikNum + "?key=" + key,
  //     });
  //     if (result.data.status == 1) {
  //       setNamaEmployee(result.data.data.nama);
  //     } else {
  //       alert("Nik tidak terdaftar!");
  //       window.open("/", "_self");
  //     }
  //   };
  //   fetchData();
  // }, []);

  const sendCheck = (action) => {
    let data = {
      key: key,
      type: action,
      nik: nikNum,
    };
    axios({
      url: URL,
      method: "POST",
      headers: { "content-type": "application/x-www-form-urlencoded" },
      data: qs.stringify(data),
    }).then((res) => {
      if (res.data.status == "success") {
        alert("Absen Berhasil!");
        window.open("/", "_self");
      } else {
        alert("Absen gagal, Silahkan Coba Lagi!");
      }
    });
  };

  // console.log(namaEmployee);

  const timeout = setTimeout(() => {
    let newDate = new Date();
    setData(newDate);
  }, 60000);

  return (
    <>
      <NavbarApp appBarData={{ isMenu: 0, title: "Masuk / Pulang" }} />
      <Container className={classes.root}>
        <Icon className={classes.photo}>face</Icon>
        <Typography className={classes.nama}>
          <div>dashboard</div>
        </Typography>
      </Container>
    </>
  );
};

const useStyles = makeStyles((theme) => ({
  root: {
    // color: "#dddddd"
    marginTop: ".5rem",
    textAlign: "center",
  },
  title: {
    textAlign: "left",
    marginLeft: ".2rem",
    fontWeight: "bold",
    color: "#333333",
  },
  boxTime: {
    marginTop: ".8rem",
    padding: "1rem",
    borderRadius: ".5rem",
    // backgroundColor: "#C9E1F6"
  },
  timer: {
    textAlign: "center",
    fontSize: "2em",
    color: "#333333",
  },
  dater: {
    textAlign: "center",
    fontSize: "1.5em",
    color: "#333333",
  },
  icon: {
    float: "0px",
  },
  nik: {
    textAlign: "center",
    color: "#333333",
    fontSize: "1.5em",
  },
  nama: {
    color: "#333333",
    textAlign: "center",
    fontSize: "1.8em",
  },
  buttonContainer: {
    marginTop: "2rem",
  },
  button: {
    textAlign: "center",
  },
  photo: {
    fontSize: "5rem",
    textAlign: "center",
  },
}));
