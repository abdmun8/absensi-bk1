import React from "react";

const AbsensiGuru = React.lazy(() => import("./pages/AbsensiGuru"));
const AbsensiSiswa = React.lazy(() => import("./pages/AbsensiSiswa"));
const CheckInOut = React.lazy(() => import("./pages/CheckInOut"));
const JadwalGuru = React.lazy(() => import("./pages/JadwalGuru"));
const KelasToday = React.lazy(() => import("./pages/KelasToday"));
const ReaderQR = React.lazy(() => import("./pages/ReaderQR"));

const routes = [
  { path: "/", exact: true, name: "Home" },
  {
    path: "/absensi-guru",
    exact: true,
    name: "Absensi Guru",
    component: AbsensiGuru,
  },
  {
    path: "/absensi-siswa",
    exact: true,
    name: "Absensi Siswa",
    component: AbsensiSiswa,
  },
  {
    path: "/checkinout",
    exact: true,
    name: "Check In / Check Out",
    component: CheckInOut,
  },
  {
    path: "/jadwal-guru",
    exact: true,
    name: "Jadwal Guru",
    component: JadwalGuru,
  },
  {
    path: "/kelas-today",
    exact: true,
    name: "jadwal Hari Ini",
    component: KelasToday,
  },
  {
    path: "/qr-reader",
    exact: true,
    name: "QR Reader",
    component: ReaderQR,
  },
  // { path: "/dashboard", name: "Dashboard", component: Dashboard },
];

export default routes;
