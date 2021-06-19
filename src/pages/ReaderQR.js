import React, { useState } from "react";
import QrReader from "react-qr-reader";
import NavbarApp from "../templates/NavbarApp";
import Typography from "@material-ui/core/Typography";
import { makeStyles } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import Container from "@material-ui/core/Container";

const useStyles = makeStyles(theme => ({
  root: {
    marginTop: theme.spacing(7),
    padding: theme.spacing(2),
  },
  instruction: {
    textAlign: 'center',
    fontSize: "1.2em"
  },
  paper: {
    marginTop: theme.spacing(2),
    padding: '1rem'
  },
}));

export default ({ location }) => {

  const [data, setData] = useState('');
  const classes = useStyles();
  const handleScan = data => {
    if (data) {
      // setData(data);
      // window.open('/check?nik='+data, '_self')
    }
  };

  const handleError = err => {
    console.log(err);
  };

  return (
    <React.Fragment>
      <NavbarApp appBarData={{ 'isMenu': 0, 'title': 'SCAN QR' }} />
      <div className={classes.root}>
        <QrReader
          delay={300}
          onError={handleError}
          onScan={handleScan}
          style={{ width: "100%" }}
        />
        <Paper className={classes.paper}>
          <Typography className={classes.instruction}>
            Arahkan Kamera Lurus Pada QR<br />
            sampai QR Code terbaca<br />
            atau muncul dialog pilihan kelas
        </Typography>
        </Paper>
      </div>
    </React.Fragment>
  );
}
