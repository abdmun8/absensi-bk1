import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import SwipeableDrawer from "@material-ui/core/SwipeableDrawer";
import List from "@material-ui/core/List";
import Divider from "@material-ui/core/Divider";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import Icon from "@material-ui/core/Icon";
import ListItemText from "@material-ui/core/ListItemText";
// import SettingIcon from "@material-ui/icons/Settings";
import HomeIcon from "@material-ui/icons/Home";
import LogoutIcon from "@material-ui/icons/ExitToApp";
import IconButton from "@material-ui/core/IconButton";
import { Link } from "react-router-dom";
import MenuIcon from "@material-ui/icons/Menu";
import BackIcon from "@material-ui/icons/ArrowBack";
import Avatar from "@material-ui/core/Avatar";
import Typography from "@material-ui/core/Typography";
import { logout } from "../../utils/JWTAuth";
import { useSelector, useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";

export default function SwipeableTemporaryDrawer(props) {
  const navigate = useNavigate();
  const classes = useStyles();
  const currentUser = useSelector((state) => state.currentUser);
  const menus = useSelector((state) => state.menus);
  const [state, setState] = React.useState({
    left: false,
  });

  const dispatch = useDispatch();

  const toggleDrawer = (side, open) => (event) => {
    if (
      event &&
      event.type === "keydown" &&
      (event.key === "Tab" || event.key === "Shift")
    ) {
      return;
    }

    setState({ ...state, [side]: open });
  };

  if (!currentUser) return <div />;

  const sideList = (side) => (
    <div
      className={classes.list}
      role="presentation"
      onClick={toggleDrawer(side, false)}
      onKeyDown={toggleDrawer(side, false)}
    >
      <Avatar
        src={
          currentUser?.jk === "L"
            ? "assets/img/male.svg"
            : "assets/img/female.svg"
        }
        className={classes.primaryAvatar}
      ></Avatar>
      <Typography className={classes.textName}>{currentUser?.name}</Typography>
      <Typography className={classes.textNik}>{currentUser?.nik}</Typography>
      <Divider />
      <List>
        <ListItem button component={Link} to="/dashboard">
          <ListItemIcon>
            <HomeIcon />
          </ListItemIcon>
          <ListItemText primary="Home" />
        </ListItem>
        {/* icon
: 
"person"
iconColor
: 
"red"
idMenu
: 
1
link
: 
"/absensi-guru"
title
: 
"Absensi Guru" */}
        {menus?.map((item) => (
          <ListItem
            key={item.idMenu}
            button
            component={Link}
            to={item.link}
          >
            <ListItemIcon>
              {/* <HomeIcon /> */}
              <Icon>{item.icon}</Icon>
            </ListItemIcon>
            <ListItemText primary={item.title} />
          </ListItem>
        ))}
        <ListItem button>
          <ListItemIcon>
            <LogoutIcon />
          </ListItemIcon>
          <ListItemText
            onClick={() => {
              let isLoggedOut = logout();
              if (isLoggedOut) {
                dispatch({ type: "SET_CURRENT_USER", payload: null });
                dispatch({ type: "TOGGLE_LOGIN", payload: false });
                localStorage.removeItem("TOKEN");
                navigate("/login");
              }
            }}
            primary="Logout"
          />
        </ListItem>
      </List>
    </div>
  );

  return (
    <div>
      {/* <Button onClick={toggleDrawer('left', true)}>Open Left</Button> */}
      <IconButton
        onClick={toggleDrawer("left", true)}
        edge="start"
        className={classes.menuButton}
        color="inherit"
        aria-label="Menu"
      >
        {props.appBarData.isMenu ? (
          <MenuIcon />
        ) : (
          <Link className={classes.link} to="/">
            <BackIcon />
          </Link>
        )}
      </IconButton>
      <SwipeableDrawer
        open={state.left}
        onClose={toggleDrawer("left", false)}
        onOpen={toggleDrawer("left", true)}
      >
        {sideList("left")}
      </SwipeableDrawer>
    </div>
  );
}

const useStyles = makeStyles((theme) => ({
  list: {
    width: 250,
  },
  fullList: {
    width: "auto",
  },
  menuButton: {
    marginRight: theme.spacing(2),
  },
  primaryAvatar: {
    margin: 20,
    width: 80,
    height: 80,
    color: "#fff",
    backgroundColor: "#661FFF",
  },
  textName: {
    marginLeft: 20,
    fontSize: "1.2em",
    fontFamily: "Ubuntu",
  },
  textNik: {
    fontSize: 14,
    marginLeft: 20,
    marginBottom: 20,
    fontFamily: "Ubuntu",
  },
  textAvatar: {
    fontSize: 40,
    fontFamily: "Ubuntu",
  },
}));
