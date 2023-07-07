import { menuInside, menuOutside } from "../constants/menus";

export const getMenus = (inside = true) => {
  if (inside) return menuInside;
  return menuOutside;
};

export const getMenusByDomain = (host) => {
  const regex = new RegExp(
    /^(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/
  );
  if (regex.test(host)) return menuInside;
  return menuOutside;
};
