/**
 * Created by fruit on 1/25/2019.
 */

const statuses = {
  0: 'Not confirmed',
  1: 'Not finished',
  2: 'Finished'
}

function getStatus (id) {
  return statuses[id]
}

let statusOptions = Object.keys(statuses).map(key => {
  return {
    text: statuses[key],
    value: key
  }
})

function getTrainingStatus (training) {
  return training.participants && training.participants.some(x => x.status !== 2) ? 'Not Finished' : 'Finished'
}

export { statuses, statusOptions, getStatus, getTrainingStatus }
