import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import Table from "@material-ui/core/Table";
import TableBody from "@material-ui/core/TableBody";
import TableCell from "@material-ui/core/TableCell";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import Paper from "@material-ui/core/Paper";
import NavbarApp from "../components/templates/NavbarApp";
import Switch from "@material-ui/core/Switch";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Radio from "@material-ui/core/Radio";
import { Redirect } from "react-router-dom";

const useStyles = makeStyles((theme) => ({
  root: {
    padding: theme.spacing(2),
    marginTop: theme.spacing(7),
  },
  paper: {
    // width: '100%',
    // padding: theme.spacing(2),
    overflowX: "auto",
  },
  table: {
    // minWidth: 650,
  },
}));

function createData(name, calories, fat, id) {
  return { name, calories, fat, id };
}

const rows = [
  createData("Frozen yoghurt", true, 6.0, 1),
  createData("Ice cream sandwich", false, 9.0, 2),
  createData("Eclair", false, 16.0, 3),
  createData("Cupcake", true, 3.7, 4),
  createData("Gingerbread", false, 16.0, 5),
  createData("Gingerbread", false, 16.0, 6),
  createData("Gingerbread", false, 16.0, 7),
  createData("Gingerbread", false, 16.0, 8),
  createData("Gingerbread", false, 16.0, 9),
];

export default function SimpleTable() {
  const classes = useStyles();
  const [selectedValue, setSelectedValue] = React.useState("a");

  function handleChange(event) {
    setSelectedValue(event.target.value);
  }

  return (
    <React.Fragment>
      <NavbarApp appBarData={{ isMenu: 0, title: "Absensi Siswa" }} />
      <div className={classes.root}>
        <Paper className={classes.paper}>
          <Table className={classes.table}>
            <TableHead>
              <TableRow>
                <TableCell>Nama</TableCell>
                <TableCell>Hadir</TableCell>
                <TableCell align="center">Ket.</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {rows.map((row) => (
                <TableRow key={row.name}>
                  <TableCell component="th" scope="row">
                    {row.name}
                  </TableCell>
                  <TableCell align="right">
                    <FormControlLabel
                      control={
                        <Switch
                          checked={row.calories}
                          // onChange={handleChange('urlOutside')}
                          value="urlOutside"
                          color="primary"
                        />
                      }
                      // label="Luar Sekolah"
                    />
                  </TableCell>
                  <TableCell align="left">
                    <FormControlLabel
                      value="other"
                      label="Sakit"
                      control={
                        <Radio
                          checked={selectedValue === "a"}
                          onChange={handleChange}
                          value="a"
                          name={`radio-${row.id}`}
                          color="primary"
                          inputProps={{ "aria-label": "A" }}
                        />
                      }
                    />

                    <FormControlLabel
                      value="ijin"
                      label="Ijin"
                      control={
                        <Radio
                          checked={selectedValue === "b"}
                          onChange={handleChange}
                          value="b"
                          label="Izin"
                          name={`radio-${row.id}`}
                          color="primary"
                          inputProps={{ "aria-label": "B" }}
                        />
                      }
                    />

                    <FormControlLabel
                      value="alpa"
                      label="Alpa"
                      control={
                        <Radio
                          checked={selectedValue === "b"}
                          onChange={handleChange}
                          value="b"
                          label="Izin"
                          name={`radio-${row.id}`}
                          color="primary"
                          inputProps={{ "aria-label": "B" }}
                        />
                      }
                    />

                    {/* {row.fat} */}
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </Paper>
      </div>
    </React.Fragment>
  );
}
