
const coinflip = (percentage) => {
  const n = percentage / 100;
  return !!n && Math.random() <= n;
}

export default coinflip;
