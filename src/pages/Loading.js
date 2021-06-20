import React from "react";
import { useSelector } from "react-redux";
import { useHistory } from "react-router-dom";

const Loading = () => {
  const user = useSelector((state) =>
    JSON.parse(window.atob(state.currentUser))
  );
  const history = useHistory();
  console.log(user);
  console.log(Object.entries(user).length);
  if (Object.entries(user).length) {
    history.push("/dashboard");
  } else {
    history.push("/login");
  }

  return <div>Loading..</div>;
};

export default Loading;
