import React, { useState } from "react";
import Navbar from "../templates/NavbarApp";
import { makeStyles } from "@material-ui/core/styles";
import Card from "@material-ui/core/Card";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardActions from "@material-ui/core/CardActions";
import CardContent from "@material-ui/core/CardContent";
import CardMedia from "@material-ui/core/CardMedia";
import Button from "@material-ui/core/Button";
import Typography from "@material-ui/core/Typography";
import Avatar from "@material-ui/core/Avatar";
import { useSelector, useDispatch } from "react-redux";
import { absenGuru } from "../../utils/JWTAuth";
import Loading from "../templates/Loading";

const useStyles = makeStyles(theme => ({
  "@global": {
    body: {
      backgroundColor: theme.palette.common.white
    }
  },
  paper: {
    marginTop: theme.spacing(1),
    position: "absolute",
    left: 0,
    right: 0,
    marginLleft: "auto",
    marginRight: "auto"
  },
  logo: {
    position: "absolute",
    left: 0,
    right: 0,
    top: theme.spacing(2),
    margin: "auto",
    width: "6rem",
    height: "6rem"
    // marginBottom: theme.spacing(1)
  },
  card: {
    margin: theme.spacing(9, 2, 2, 2)
  },
  media: {
    backgroundColor: "#c2c2d6",
    height: 140
  },
  cardContent: {
    textAlign: "center"
  },
  date: {
    marginBottom: ".4rem",
    marginTop: "2rem"
  },
  cardFooter: {
    // alignItems: 'center'
    justifyContent: "center"
  },
  button: {
    margin: theme.spacing(3, 0, 2),
    backgroundColor: "#661FFF",
    paddingLeft: theme.spacing(5),
    paddingRight: theme.spacing(5),
    borderRadius: 25
  },
  font: {
    fontFamily: "Ubuntu"
  }
}));
export default () => {
  const classes = useStyles();
  const currentUser = useSelector(state => state.currentUser);
  const isCheckedIn = useSelector(state => state.checkedIn);
  const date = new Date();
  const dayNames = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jum'at",
    "Sabtu"
  ];
  const initial_time = date.getHours() + ":" + date.getMinutes();
  const [time, setTime] = useState(initial_time);
  const dispatch = useDispatch(state => state.checkedIn);
  const interval = setInterval(() => {
    let dt = new Date();
    setTime(dt.getHours() + ":" + dt.getMinutes());
  }, 60000);

  const handleCheckin = async () => {
    let action = {
      id: currentUser.id,
      type: isCheckedIn ? "Pulang" : "Masuk"
    };
    let response = await absenGuru(action);
    if (response && response.success) {
      dispatch({ type: "TOGGLE_CHECKIN", payload: isCheckedIn });
    }
    alert(response.message);
  };

  return (
    <React.Fragment>
      <Navbar appBarData={{ isMenu: 0, title: "Absensi Guru" }} />
      <Card className={classes.card}>
        <CardActionArea>
          <Avatar
            src={
              currentUser.jk === "L"
                ? "assets/img/male.svg"
                : "assets/img/female.svg"
            }
            className={classes.logo}
          />
          <CardMedia
            className={classes.media}
            image="male.svg"
            src=""
            title={currentUser.name}
          />

          <CardContent className={classes.cardContent}>
            <Typography
              gutterBottom
              variant="h5"
              component="h2"
              className={classes.font}
            >
              {currentUser.name}
            </Typography>
            <Typography className={classes.date} component="p">
              {dayNames[date.getDay()] + " - " + date.toLocaleDateString()}
            </Typography>
            <Typography gutterBottom variant="h2" component="h2">
              {time}
            </Typography>
          </CardContent>
        </CardActionArea>
        <CardActions className={classes.cardFooter}>
          <Button
            type="button"
            // fullWidth
            size="large"
            variant="contained"
            color="primary"
            className={classes.button}
            onClick={handleCheckin}
          >
            {isCheckedIn ? "PULANG" : "MASUK"}
          </Button>
        </CardActions>
      </Card>
    </React.Fragment>
  );
};
