exports.monthlyUmkm = (umkmId = null, startDate = null, endDate = null) => {
  let condition = '';

  if (umkmId || startDate || endDate) {
    condition += '?';
  }

  if (umkmId) {
    condition += `umkm_id=${umkmId}&`;
  }

  if (startDate) {
    condition += `mulai_bulan=${startDate}&`;
  }
  
  if (endDate) {
    condition += `sampai_bulan=${endDate}`;
  }
  return axios.get(`/report/umkm-monthly/${condition}`);
}
