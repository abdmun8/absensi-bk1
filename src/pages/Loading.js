import React from "react";
import { useSelector } from "react-redux";
import { useHistory } from "react-router-dom";

const Loading = () => {
  const user = useSelector((state) => state.currentUser);
  const history = useHistory();
  if (Object.entries(user).length) {
    history.push("/admin");
  } else {
    history.push("/login");
  }

  return <div>Loading..</div>;
};

export default Loading;
