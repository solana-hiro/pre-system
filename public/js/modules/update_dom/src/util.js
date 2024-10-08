const PROD_BASE = 'https://wundou-prod.s3.ap-northeast-1.amazonaws.com';
const DEV_BASE = 'https://wundou-dev.s3.ap-northeast-1.amazonaws.com';

// 前0でパティング 桁/値いずれか未指定であればパディングしない
export const padZero = (v, l) => {
  if (!l) return v;

  return v ? v.padStart(l, '0') : v;
}

// S3URL生成
export const s3Url = (s) => {
  const base = Environment === 'prod' ? PROD_BASE : DEV_BASE;
  return s ? new URL(s, base) : '';
} 