import { menuInside, menuOutside } from "../constants/menus";

export const getMenus = (outside = true) => {
  if (outside) return menuOutside;
  return menuInside;
};

export const getMenusByDomain = (host) => {
  const regex = new RegExp(
    /^(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/
  );
  if (regex.test(host)) return menuInside;
  return menuOutside;
};
