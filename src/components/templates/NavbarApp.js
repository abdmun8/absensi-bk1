import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import Typography from "@material-ui/core/Typography";
import IconButton from "@material-ui/core/IconButton";
import BackIcon from "@material-ui/icons/ArrowBack";
import { Link } from "react-router-dom";
import MenuIcon from "@material-ui/icons/Menu";
import Drawer from "./Drawer"

const useStyles = makeStyles(theme => ({
  root: {
    flexGrow: 1,
    position: "fixed",
    top: 0,
    width: "100%",
    zIndex: 1
  },
  appBar: {
    color: "white",
    backgroundColor: "#661FFF"
  },
  menuButton: {
    marginRight: theme.spacing(2)
  },
  title: {
    flexGrow: 1
  },
  link: {
    textDecoration: "none",
    color: "white"
  }
}));
const ButtonAppBar = props => {
  const classes = useStyles();

  return (
    <div className={classes.root}>
      <AppBar className={classes.appBar} position="static">
        <Toolbar>
          <Drawer appBarData={{ isMenu: 1}} />
          {/* <IconButton
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
          </IconButton> */}
          <Typography variant="h6" className={classes.title}>
            {props.appBarData.title}
          </Typography>
        </Toolbar>
      </AppBar>
    </div>
  );
};

export default ButtonAppBar;
