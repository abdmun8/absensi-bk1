create view v_sub_kelas as SELECT s.*, g.nama AS nama_guru,t.tipe,e.nama AS nama_pic_eksternal FROM sub_kelas s
INNER JOIN tipe_sub_kelas t ON s.tipe_id = t.id
LEFT JOIN pic_eksternal e ON s.pic = e.id
LEFT JOIN guru g ON s.wali_kelas = g.id


create view v_jadwalsekolah AS SELECT j.*,t.nama_libur,t.keterangan
FROM jadwal_sekolah j
JOIN tipe_libur t ON j.tipe_libur = t.id


CREATE VIEW v_penugasan AS SELECT p.*, k.nama_kelas, pe.nama nama_pic, g.nama nama_guru,g.nik
FROM penugasan p
JOIN kelas k ON k.id= p.id_kelas
LEFT JOIN pic_eksternal pe ON p.id_guru_pic= pe.id
LEFT JOIN guru g ON p.id_guru= g.id
