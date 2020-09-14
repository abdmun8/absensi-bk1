import React from "react";
import Typography from "@material-ui/core/Typography";
import Container from "@material-ui/core/Container";
import Icon from "@material-ui/core/Icon";
import { makeStyles } from "@material-ui/core/styles";
import Grid from "@material-ui/core/Grid";
import Box from "@material-ui/core/Box";
import ButtonBase from "@material-ui/core/ButtonBase";
import { shadows } from '@material-ui/system';
// import axios from "axios";
import Navbar from "./NavbarApp";
import { Link } from "react-router-dom";
import { useSelector } from 'react-redux';

const useStyles = makeStyles(theme => ({
  root: {
    flexGrow: 1,
    marginTop: theme.spacing(10),
    marginLeft: theme.spacing(1),
    marginRight: theme.spacing(1)
  },
  gridItem: {
    textAlign: "center"
  },
  box: {
    padding: ".5rem",
    textAlign: "center",
    color: theme.palette.text.secondary,
    borderRadius: "1rem"
  },
  boxWhite: {
    backgroundColor: "#FFFFFF",
  },
  icon: {
    margin: theme.spacing(2),
    fontSize: "2.8em"
  },
  iconWhite: {
    color: "#505F79"
  },
  text: {
    textAlign: "center",
    marginTop: ".5rem",
    fontSize: ".8em",
    fontFamily: "Ubuntu",
    // fontWeight: "700",
    color: "#505F79"
  }
}));

export default function Menu() {
  const classes = useStyles();
  const menus = useSelector(state => state.menus);

  return (
    <React.Fragment>
      <Navbar appBarData={{ isMenu: 1, title: "SMK BK1" }} />
      <Container maxWidth="sm">
        <div className={classes.root}>
          <Grid container spacing={3}>
            {menus &&
              menus.map(item => (
                <Grid
                  key={item.idMenu}
                  className={classes.gridItem}
                  item
                  xs={4}
                >
                  <ButtonBase>
                    <Link to={item.link}>
                      <Box boxShadow={1}
                        className={`${classes.box} ${classes.boxWhite}`}
                      >
                        <Icon
                          className={`${classes.icon} ${classes.iconWhite}`}
                        >
                          {item.icon}
                        </Icon>
                      </Box>
                    </Link>
                  </ButtonBase>
                  <Typography className={classes.text}>{item.title}</Typography>
                </Grid>
              ))}
          </Grid>
        </div>
      </Container>
    </React.Fragment>
  );
}
