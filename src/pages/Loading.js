import React, { useEffect } from "react";
import { useSelector } from "react-redux";
import { useHistory } from "react-router-dom";
import _ from "lodash";

const Loading = () => {
  const history = useHistory();
  // const user = useSelector((state) => state.currentUser);

  // useEffect(() => {
  //   const timeout = setTimeout(() => {
  //     history.push("/login");
  //   }, 3000);
  //   if (!_.isEmpty(user)) {
  //     clearTimeout(timeout);
  //     history.push("/dashboard");
  //   }
  // }, [user]);

  return <div>Loading..</div>;
};

export default Loading;
